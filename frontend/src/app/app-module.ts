import { NgModule, provideBrowserGlobalErrorListeners ,provideZoneChangeDetection } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from '@angular/common';
import { AppRoutingModule } from './app-routing-module';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {MatProgressBarModule} from '@angular/material/progress-bar';
 // Rutas
import { App } from './app';
import { Home } from './components/home/home';
import { Footer } from './components/footer/footer';
import { Login } from './components/login/login';
import { Registro } from './components/registro/registro';
import { Eleccion } from './components/eleccion/eleccion';
import { PerfilRegistro } from './components/perfil-registro/perfil-registro';
import { Atributos } from './components/usuarios/atributos/atributos';
import { HomeEstudiante } from './components/usuarios/home-estudiante/home-estudiante';
import { Solicitudes } from './components/usuarios/solicitudes/solicitudes';
import { Perfil } from './components/usuarios/perfil/perfil';
import { VistaPiso } from './components/vista-piso/vista-piso';
import { InmueblesPropietario } from './components/propietarios/inmuebles-propietario/inmuebles-propietario';
import { Publicar } from './components/propietarios/publicar/publicar';
import { PerfilPropietario } from './components/propietarios/perfil-propietario/perfil-propietario';
import { HomePropietario } from './components/propietarios/home-propietario/home-propietario';
import { VistaInmueblePropietario } from './components/propietarios/vista-inmueble-propietario/vista-inmueble-propietario';
import { Header } from './components/header/header';
import { HeaderPropietario } from './components/propietarios/header-propietario/header-propietario';



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
    Solicitudes,
    Perfil,
    VistaPiso,
    InmueblesPropietario,
    Publicar,
    PerfilPropietario,
    HomePropietario,
    VistaInmueblePropietario,
    Header,
    HeaderPropietario

   

  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    CommonModule,
    HttpClientModule,
    BrowserAnimationsModule,
    MatProgressBarModule
  ],
  providers: [
    provideBrowserGlobalErrorListeners(),
    provideZoneChangeDetection()
  ],
  bootstrap: [App]
})
export class AppModule { }
