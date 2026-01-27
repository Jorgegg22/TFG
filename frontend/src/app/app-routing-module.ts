import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Home } from './components/home/home';
import { Login } from './components/login/login';
import { Registro } from './components/registro/registro';
import { Eleccion } from './components/eleccion/eleccion';
import { PerfilRegistro } from './components/perfil-registro/perfil-registro';
import { Atributos } from './components/usuarios/atributos/atributos';
import { HomeEstudiante } from './components/usuarios/home-estudiante/home-estudiante';

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
  }


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
