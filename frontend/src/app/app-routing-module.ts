import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { Home } from './components/home/home';
import { Login } from './components/login/login';
import { Registro } from './components/registro/registro';

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
  }


];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
