import { Component, OnInit } from '@angular/core';
import { UniversidadesS } from '../../services/universidades';
import { Universidad } from '../../common/universidades-interface';

@Component({
  selector: 'app-perfil-registro',
  standalone: false,
  templateUrl: './perfil-registro.html',
  styleUrl: './perfil-registro.css',
})
export class PerfilRegistro implements OnInit {

  unis:Universidad[] =[]

  constructor(private unservice: UniversidadesS) {
  }

  ngOnInit(): void {
    /* this.loadUniversidades(); */
  }

  /* loadUniversidades(){
    this.unservice.getUniversidades().subscribe({
      next:(value) => {

        console.log(value);
        this.unis = Array.isArray(value) ? value : [value];
        
      },
      error:(err) =>{
        console.error(err)
      }
    })
  } */

}
