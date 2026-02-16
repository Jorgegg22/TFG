import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
// Sirve para redirigir a otra pagina ** Similar a routerLink
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  //private URI: string = "http://localhost/univibe/backend/public/index.php/api/auth/";  // XAMPP
  //private URI: string = 'http://localhost:8080/api/auth/'; // DOCKER
  private URI: string = 'https://jorgegomez.com.es/univibe/backend/public/index.php/api/auth/';
  constructor(private http: HttpClient) {}

  register(userData: any): Observable<any> {
    return this.http.post(`${this.URI}register`, userData);
  }

  chooseRol(userData: any): Observable<any> {
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
    return this.http.post(`${this.URI}rol`, userData,httpOptions);
  }

  checkUser(userData: any): Observable<any> {
    return this.http.post(`${this.URI}login`, userData);
  }

  logout(): Observable<any> {
    return this.http.get(`${this.URI}logout`);
  }
}
