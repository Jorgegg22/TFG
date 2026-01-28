import { NgModule, provideBrowserGlobalErrorListeners } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing-module';
import { App } from './app';
import { Home } from './components/home/home';
import { Footer } from './components/footer/footer';
import { Login } from './components/login/login';
import { Registro } from './components/registro/registro';
import { Eleccion } from './components/eleccion/eleccion';
import { PerfilRegistro } from './components/perfil-registro/perfil-registro';
import { Atributos } from './components/usuarios/atributos/atributos';
import { HomeEstudiante } from './components/usuarios/home-estudiante/home-estudiante';

@NgModule({
  declarations: [
    App,
    Home,
    Footer,
    Login,
    Registro,
    Eleccion,
    PerfilRegistro,
    Atributos,
    HomeEstudiante,

  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [
    provideBrowserGlobalErrorListeners(),
  ],
  bootstrap: [App]
})
export class AppModule { }
