import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Inmueble } from '../common/inmuebles-interface';
import { InmuebleDetalle } from '../common/pisoDetalle-interface';

@Injectable({
  providedIn: 'root',
})
export class InmuebleService {
  //private URI: string = "http://localhost/univibe/backend/public/index.php/api/inmuebles/"; //XAMPP
  //private URI: string = 'http://localhost:8080/api/inmuebles/'; //DOCKER
  private URI: string = 'https://jorgegomez.com.es/univibe/backend/public/index.php/api/inmuebles/';
  constructor(private http: HttpClient) {}

  getInmueblesFiltrados(): Observable<Inmueble[]> {
    //Cogemos la sesion
    const sesionStr = localStorage.getItem('sesion');
    //Convertimos en objeto sesionStr,para acceder al token
    const sesionObj = JSON.parse(sesionStr || '{}');
    const token = sesionObj.token;

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(token),
      }),
    };
    return this.http.get<Inmueble[]>(`${this.URI}lista`, httpOptions);
  }

  getInmueblesFiltradoUniversidad(): Observable<Inmueble[]> {
    //Cogemos la sesion
    const sesionStr = localStorage.getItem('sesion');
    //Convertimos en objeto sesionStr,para acceder al token
    const sesionObj = JSON.parse(sesionStr || '{}');
    const token = sesionObj.token;

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(token),
      }),
    };

    return this.http.get<Inmueble[]>(`${this.URI}listaUni`, httpOptions);
  }

  getInmueblesAleatorios(): Observable<Inmueble[]> {
    //Cogemos la sesion
    const sesionStr = localStorage.getItem('sesion');
    //Convertimos en objeto sesionStr,para acceder al token
    const sesionObj = JSON.parse(sesionStr || '{}');
    const token = sesionObj.token;

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(token),
      }),
    };
    return this.http.get<Inmueble[]>(`${this.URI}listaAleatoria`, httpOptions);
  }

  getInmueble(id: string): Observable<InmuebleDetalle> {
    return this.http.get<InmuebleDetalle>(`${this.URI}/inmuebleDetalle/` + id);
  }

  postSolicitud(houseId: number) {
    //Cogemos la sesion
    const sesionStr = localStorage.getItem('sesion');
    //Convertimos en objeto sesionStr,para acceder al token
    const sesionObj = JSON.parse(sesionStr || '{}');
    const token = sesionObj.token;

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(token),
      }),
    };
    return this.http.post(`${this.URI}/postSolicitud`, { houseId: houseId }, httpOptions);
  }

  updateInmueble(inmData: any): Observable<any> {const sesionStr = localStorage.getItem('sesion');
      const sesionObj = JSON.parse(sesionStr || '{}');
  
      const httpOptions = {
        headers: new HttpHeaders({
          'X-API-TOKEN': String(sesionObj.token || ''),
        }),
      };

    return this.http.post(`${this.URI}/actualizarInmueble`, inmData,httpOptions);
  }
}
