import { Component, OnInit } from '@angular/core';
import { InmuebleService } from '../../services/inmuebles-service';
import { ActivatedRoute } from '@angular/router';
import { InmuebleDetalle, Solicitud, Match } from '../../common/pisoDetalle-interface';



@Component({
  selector: 'app-vista-piso',
  standalone: false,
  templateUrl: './vista-piso.html',
  styleUrl: './vista-piso.css',
})
export class VistaPiso implements OnInit {


  idInmueble!:string;
  info!:InmuebleDetalle;
  solicitudes:Solicitud[] = [];
  matches:Match[] = [];


  ngOnInit(): void {
    this.loadInmueble()
  }

  constructor(
    private inmService: InmuebleService,
    private activatedRoute:ActivatedRoute
  ) {}


  loadInmueble(){
    this.idInmueble = this.activatedRoute.snapshot.params['id'];
    this.inmService.getInmueble(this.idInmueble).subscribe({
      next:(respuesta) => {
        console.log('hay piso');
        this.info = respuesta;
        this.solicitudes = this.info.solicitudes;
        this.matches = this.info.matches;   
        console.log(this.info);
        console.log( this.solicitudes);
        console.log(this.matches);
        
        
             
      }
    })

  }
}
