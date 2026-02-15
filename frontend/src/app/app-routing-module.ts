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
import { Error } from './components/error/error';

import { authRoleGuard } from './guards/auth-role-guard';

const routes: Routes = [
  // RUTAS GENERALES
  {
    path: 'home',
    component: Home,
  },
  {
    path: '',
    component: Home,
  },
  {
    path: 'login',
    component: Login,
  },
  {
    path: 'registro',
    component: Registro,
  },
  {
    path: 'eleccion',
    component: Eleccion,
  },
  {
    path: 'registro-perfil',
    component: PerfilRegistro,
  },
  // RUTAS ESTUDIANTES
  {
    path: 'atributos',
    component: Atributos,
  },
  {
    path: 'home-estudiante',
    component: HomeEstudiante,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['estudiante'] },
  },
  {
    path: 'solicitudes-estudiante',
    component: Solicitudes,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['estudiante'] },
  },

  {
    path: 'mi-perfil',
    component: Perfil,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['estudiante', 'propietario'] },
  },

  {
    path: 'perfil/:id',
    component: Perfil,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['estudiante', 'propietario'] },
  },
  {
    path: 'piso-detalle/:id',
    component: VistaPiso,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['estudiante', 'propietario'] },
  },
  {
    path: 'home-propietario',
    component: HomePropietario,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['propietario'] },
  },
  {
    path: 'inmuebles-propietario',
    component: InmueblesPropietario,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['propietario'] },
  },
  {
    path: 'publicar',
    component: Publicar,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['propietario'] },
  },
  {
    path: 'perfil-propietario',
    component: PerfilPropietario,
    canActivate: [authRoleGuard],
    data: { expectedRoles: ['propietario'] },
  },
  {
    path: '**',
    component: Error,
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
