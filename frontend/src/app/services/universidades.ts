import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Universidad } from '../common/universidades-interface';
import { Carrera } from '../common/carreras-interface';

@Injectable({
  providedIn: 'root'
})
export class UniversidadService {
  //private URI: string = "http://localhost/univibe/backend/public/index.php/api/";  //XAMPP
  private URI: string = "http://localhost:8080/api/"; //DOCKER
  constructor(private http: HttpClient) {
   
  }

  getUniversidades(): Observable<Universidad[]>{
    return this.http.get<Universidad []>(`${this.URI}universidades`  );
  }

  getCarreras(): Observable<Carrera[]>{
    return this.http.get<Carrera[]>(`${this.URI}carreras`  );
  }

  



}

