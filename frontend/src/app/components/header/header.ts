import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  standalone: false,
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header implements OnInit {

  userId!:string | null
  options:boolean = false
  
  ngOnInit(): void {
    const datosSesion = localStorage.getItem('sesion');

if (datosSesion) {
  const sesionObj = JSON.parse(datosSesion);
  this.userId = sesionObj.id;
}
  }


  showOptions(){
    this.options = !this.options
  }

}
