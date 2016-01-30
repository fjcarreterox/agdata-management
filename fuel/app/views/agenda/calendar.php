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
                    $title = "Visita a ";
                    $fondo = "";
                    foreach($eventos as $id => $e){
                        if($e['tipo']== 3){$title = "Auditoría a "; $fondo = ", backgroundColor: '#a00', borderColor: '#a00' ";}
                        echo "{id:$id, title:'".$title.html_entity_decode($e["cliente"])."', data_type:'".$e["tipo"]."', start:'".$e["fecha"]."T".$e["hora"]."', url:'../clientes/view/".$e["idcliente"]."', description:'".$e["obs"]."'".$fondo."},";
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
                        $("#eventContent").dialog({ modal: true, title: event.title, width:450});
                    });
                }
            });
        });
    </script>

<h2>Calendario de <span class='muted'>visitas y auditorías</span> registradas en el sistema</h2>
<p>En el siguiente calendario no se pueden borrar los eventos que aparecen. Para ello deberás volver al listado de
    <u>eventos</u> y eliminar o editar datos de los eventos que desees.</p>
<br/>
<div id="calendar"></div>
<br/>

<div id="eventContent" title="Event Details" style="display:none;">
    <p><strong>Fecha y hora:</strong></p>
    <span id="startTime"></span>
    <br/><br/>
    <p><strong>Observaciones:</strong></p>
    <p id="eventInfo"></p>
    <p><strong><a id="eventLink" href="" target="_blank">Abrir ficha de cliente</a></strong></p>
</div>

<p><?php echo Html::anchor('agenda/create', '<span class="glyphicon glyphicon-plus"></span> Crear nuevo evento', array('class' => 'btn btn-primary')); ?>&nbsp;&nbsp;
   <?php echo Html::anchor('agenda', '<span class="glyphicon glyphicon-backward"></span> Volver al listado de visitas', array('class' => 'btn btn-danger')); ?></p>