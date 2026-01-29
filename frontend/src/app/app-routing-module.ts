import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Home } from './components/home/home';
import { Login } from './components/login/login';
import { Registro } from './components/registro/registro';
import { Eleccion } from './components/eleccion/eleccion';
import { PerfilRegistro } from './components/perfil-registro/perfil-registro';
import { Atributos } from './components/usuarios/atributos/atributos';
import { HomeEstudiante } from './components/usuarios/home-estudiante/home-estudiante';
import { Solicitudes } from './components/usuarios/solicitudes/solicitudes';
import { Perfil } from './components/usuarios/perfil/perfil';
import { VistaPiso } from './components/vista-piso/vista-piso';
import { HomePropietario } from './components/propietarios/home-propietario/home-propietario';
import { InmueblesPropietario } from './components/propietarios/inmuebles-propietario/inmuebles-propietario';
import { Publicar } from './components/propietarios/publicar/publicar';
import { PerfilPropietario } from './components/propietarios/perfil-propietario/perfil-propietario';
import { VistaInmueblePropietario } from './components/propietarios/vista-inmueble-propietario/vista-inmueble-propietario';

const routes: Routes = [
  {
    path: 'home',
    component: Home
  },
  {
    path:'',
    component: Home
  },
  {
    path:'login',
    component: Login
  },
  {
    path:'registro',
    component: Registro
  },
  {
    path:'eleccion',
    component: Eleccion 
  },
  {
    path:'registro-perfil',
    component: PerfilRegistro
  },{
    path:'atributos',
    component: Atributos
  },
  {
    path:'home-estudiante',
    component: HomeEstudiante
  },{
    path:'solicitudes-estudiante',
    component:Solicitudes
  },{
    path:'perfil',
    component:Perfil
  },{
    path:'piso-detalle',
    component: VistaPiso
  },{
    path:'home-propietario',
    component:HomePropietario
  },{
    path:'inmuebles-propietario',
    component:InmueblesPropietario
  },{
    path:'publicar',
    component:Publicar
  },{
    path:'perfil-propietario',
    component:PerfilPropietario
  },{
    path:'vista-inmueble',
    component:VistaInmueblePropietario
  }


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
