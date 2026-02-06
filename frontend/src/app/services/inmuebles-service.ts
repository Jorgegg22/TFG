import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Inmueble } from '../common/inmuebles-interface';
import { InmuebleDetalle } from '../common/pisoDetalle-interface';

@Injectable({
  providedIn: 'root'
})
export class InmuebleService {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/inmuebles/";  //XAMPP
  // private URI: string = "http://localhost:8080/public/api/inmuebles/"; //DOCKER
  constructor(private http: HttpClient) {
   
  }

  getInmuebles(): Observable<Inmueble[]>{
    return this.http.get<Inmueble[]>(`${this.URI}lista`);
  }

  getInmueblesAleatorios(): Observable<Inmueble[]>{
    return this.http.get<Inmueble[]>(`${this.URI}listaAleatoria`);
  }


  getInmueble(id:string): Observable<InmuebleDetalle>{
    return this.http.get<InmuebleDetalle>(`${this.URI}/inmuebleDetalle/` + id)
  }



}

