import { Component } from '@angular/core';

@Component({
  selector: 'app-atributos',
  standalone: false,
  templateUrl: './atributos.html',
  styleUrl: './atributos.css',
})
export class Atributos {

  textoInformativo:boolean = false

  mostrarInfo(){
    this.textoInformativo = !this.textoInformativo
  }
}
