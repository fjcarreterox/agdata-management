<?php
class Controller_Usuario extends Controller_Template
{
	public function action_index(){
		$data['usuarios'] = Model_Usuario::find('all');
		$this->template->title = "Usuarios del sistema";
		$this->template->content = View::forge('usuario/index', $data);
	}

	public function action_view($id = null){
		is_null($id) and Response::redirect('usuario');

		if ( ! $data['usuario'] = Model_Usuario::find($id)){
			Session::set_flash('error', 'No se ha podido encontrar al usuario especificado.');
			Response::redirect('usuario');
		}

		$this->template->title = "Ver datos de usuario";
		$this->template->content = View::forge('usuario/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Usuario::validate('create');

			if ($val->run()){
				$usuario = Model_Usuario::forge(array(
					'nombre' => Input::post('nombre'),
					'password' => Input::post('password'),
					'user' => Input::post('user'),
					'email' => Input::post('email'),
					'role' => Input::post('role'),
				));

				if ($usuario and $usuario->save()){
					Session::set_flash('success', 'Añadido nuevo usuario al sistema.');
					Response::redirect('usuario');
				}else{
					Session::set_flash('error', 'No se ha podido crear el nuevo usuario.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Usuarios";
		$this->template->content = View::forge('usuario/create');
	}

    public function action_new_pass($id = null){

        is_null($id) and Response::redirect('usuario');
        if ( ! $user = Model_Usuario::find($id)){
            Session::set_flash('error', 'No se ha podido encontrar el usuario especificado.');
            Response::redirect('usuario');
        }
        $val = Model_Usuario::validate_new_pass('edit');
        if ($val->run()){
            $user->password = md5(Input::post('pass'));
            if ($user->save()){
                Session::set_flash('success', 'La nueva contraseña ha sido actualizada correctamente');
                Response::redirect('usuario');
            }
            else{
                Session::set_flash('error', 'Ocurrió un error al actualizar la contraseña');
            }
        }
        else{
            if (Input::method() == 'POST'){
                $user->password = $val->validated('pass');
                Session::set_flash('error', $val->error());
            }
            $this->template->set_global('user', $user, false);
        }
        $data["username"] = $user->nombre;

        $this->template->title = "Cambiar contraseña de usuario";
        $this->template->content = View::forge('usuario/_form_pass',$data);
    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('usuario');

		if ( ! $usuario = Model_Usuario::find($id)){
			Session::set_flash('error', 'No se ha podido localizar el usuario especificado.');
			Response::redirect('usuario');
		}

		$val = Model_Usuario::validate('edit');

		if ($val->run()){
			$usuario->nombre = Input::post('nombre');
			$usuario->user = Input::post('user');
			$usuario->email = Input::post('email');
			$usuario->role = Input::post('role');

			if ($usuario->save()){
				Session::set_flash('success', 'Datos de usuario actualizados.');
				Response::redirect('usuario');
			}
			else{
				Session::set_flash('error', 'No se pudo actualizar el usuario especificado.');
			}
		}
		else{
			if (Input::method() == 'POST'){
				$usuario->nombre = $val->validated('nombre');
				$usuario->user = $val->validated('user');
				$usuario->email = $val->validated('email');
				$usuario->role = $val->validated('role');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('usuario', $usuario, false);
		}

		$this->template->title = "Usuarios";
		$this->template->content = View::forge('usuario/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('usuario');

		if ($usuario = Model_Usuario::find($id)){
			$usuario->delete();
			Session::set_flash('success', 'Usuario borrado del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el usuario especificado.');
		}
		Response::redirect('usuario');
	}
}