<?php
echo Asset::js(array('moment.min.js','jquery.js','jquery-ui.min.js','fullcalendar.min.js','es.js'), array(), null, false);
echo Asset::css(array('fullcalendar.min.css','jquery-ui.css'), array(), null, false);
echo Asset::css('fullcalendar.print.css', array('media' => 'print'), null, false);
?>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: '<?php echo $default_date; ?>',
                selectable: true,
                weekends: false,
                theme: true,
                /*selectHelper: true,
                select: function(start, end) {
                    var title = prompt('Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                },*/

                timeFormat: 'H:mm', // uppercase H for 24-hour clock
                eventLimit: true, // allow "more" link when too many events
                events: [
<?php
                if(isset($eventos)){
                    foreach($eventos as $id => $e){
                        if($e['tipo']== 3){$title = "Auditoría a ".html_entity_decode($e["cliente"]); $fondo = ", backgroundColor: '#a00', borderColor: '#a00' ";}
                        elseif($e['tipo']== 4){$title = "Asuntos varios "; $fondo = ", backgroundColor: '#666', borderColor: '#333' ";}
                        elseif($e['tipo']== 5){$title = "Donkey Apartments"; $fondo = ", backgroundColor: '#deb887', borderColor: '#333' ";}
                        else{$title = "Visita a ".html_entity_decode($e["cliente"]); $fondo = "";}
                        echo "{id:$id, title:'".$title."', data_type:'".$e["tipo"]."', start:'".$e["fecha"]."T".$e["hora"]."', url:'../clientes/view/".$e["idcliente"]."', url2:'/agdata-gestion/public/agenda/edit/".$id."', description:'".$e["obs"]."'".$fondo."},";
                    }
                }
?>
                ],
                eventRender: function (event, element) {
                    element.attr('href', 'javascript:void(0);');
                    element.click(function() {
                        $("#startTime").html(moment(event.start).format('D [de] MMMM [de] YYYY, [a las] H:mm'));
                        if(event.description != ""){
                            $("#eventInfo").html(event.description);
                        }
                        else{
                            $("#eventInfo").html("SIN OBSERVACIONES AÚN.");
                        }
                        $("#eventLink").attr('href', event.url);
                        $("#eventLink").attr('title', 'Se abre en ventana nueva...');
                        $("#eventEdit").attr('href', event.url2);
                        $("#eventEdit").attr('title', 'Se abre en ventana nueva...');
                        $("#eventContent").dialog({ modal: true, title: event.title, width:450});
                    });
                }
            });
        });
    </script>

<h2>Calendario de <span class='muted'>visitas y auditorías</span> registradas en el sistema</h2>
<p>En el siguiente calendario no se pueden borrar los eventos que aparecen. Para ello deberás volver al listado de
    <u>eventos</u> y eliminar o editar datos de los eventos que desees.</p>
<?php
if(isset($cal_title)){
    echo "<h3>".$cal_title."</h3><br/>";
}
?>
<br/>
<div id="calendar"></div>
<br/>

<div id="eventContent" title="Event Details" style="display:none;">
    <p><strong>Fecha y hora:</strong></p>
    <span id="startTime"></span>
    <br/><br/>
    <p><strong>Observaciones:</strong></p>
    <p id="eventInfo"></p>
    <p><strong><a id="eventEdit" href="" target="_blank">Editar evento</a></strong>&nbsp;&nbsp;
        <strong><a id="eventLink" href="" target="_blank">Abrir ficha de cliente</a></strong></p>
</div>

<p><?php echo Html::anchor('agenda/create', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;
   <?php echo Html::anchor('agenda', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de visitas', array('class' => 'btn btn-danger')); ?></p>