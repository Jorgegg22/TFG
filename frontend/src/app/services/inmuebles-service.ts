import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Inmueble } from '../common/inmuebles-interface';

@Injectable({
  providedIn: 'root'
})
export class InmuebleService {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/inmuebles/"; // http://localhost/univibe/backend/public/index.php/api/inmuebles/ xampp - http://localhost:8080/public/api/auth/ docker

  constructor(private http: HttpClient) {
   
  }

  getInmuebles(): Observable<Inmueble[]>{
    return this.http.get<Inmueble[]>(`${this.URI}lista`);
  }

  getInmueblesAleatorios(): Observable<Inmueble[]>{
    return this.http.get<Inmueble[]>(`${this.URI}listaAleatoria`);
  }




}

