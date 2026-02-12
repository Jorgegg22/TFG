import { Component, OnInit } from '@angular/core';
import { PropietarioService } from '../../../services/propietarios-service';
import { Router } from '@angular/router';
import { SolicitudesPropietarioResponse,SolicitudesHoy } from '../../../common/solicitudesPropietario-interface';
import { ListaInmuebles } from '../../../common/inmuebles-interface';



@Component({
  selector: 'app-home-propietario',
  standalone: false,
  templateUrl: './home-propietario.html',
  styleUrl: './home-propietario.css',
})
export class HomePropietario implements OnInit {

 
  info!:SolicitudesPropietarioResponse;
  totalSolicitudes!:number
  solictudesHoy!:SolicitudesHoy[]
  urlImagenes:string = "http://localhost:8080/uploads/inmuebles_fotos/"
  inmueblesAll!:ListaInmuebles
  inmuebles!:ListaInmuebles
  currentPage:number = 1;
  totalPages!:number;
  elementsPerPage:number = 6
  initialSlice!:number
  finalSlice!:number
  loading: boolean = true;

  constructor(
    private propService:PropietarioService,
 
    
  ) {}

  ngOnInit(): void {
    this.loadSolicitudes()
    this.loadInmuebles()
    
  }


  loadSolicitudes(){
    this.propService.getSolicitudesPropietario().subscribe({
        next:(respuesta) => {
          console.log(respuesta);
          this.info = respuesta
          this.totalSolicitudes = this.info.data.inmuebles.total_solicitudes
          this.solictudesHoy = this.info.data.inmuebles.solicitudes
    
          

      }
    
    })
    
  }

  loadInmuebles(){
    this.propService.getInmueblesPropietario().subscribe({
      next:(respuesta) =>{
        console.log(respuesta);
        this.inmueblesAll = respuesta;
        this.totalPages = Math.ceil(this.inmueblesAll.length / this.elementsPerPage )
        console.log(this.totalPages);
        console.log(this.inmueblesAll.length);
        this.pagination();
        this.loading = false
        
      }
     })
  }


  pagination(){
    this.initialSlice = (this.elementsPerPage * this.currentPage) - this.elementsPerPage;
    this.finalSlice = this.initialSlice + this.elementsPerPage;
    this.inmuebles = this.inmueblesAll.slice(this.initialSlice,this.finalSlice);
  }


  nextPage(){
    this.currentPage++;
    this.pagination();
  }

  prevPage(){
    this.currentPage--;
    this.pagination();
  }



}
