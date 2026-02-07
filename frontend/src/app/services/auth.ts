import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
// Sirve para redirigir a otra pagina ** Similar a routerLink
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  /* private URI: string = "http://localhost/univibe/backend/public/index.php/api/auth/"; */ // XAMPP
  private URI: string = 'http://localhost:8080/public/api/auth/'; // DOCKER
  constructor(private http: HttpClient) {}

  register(userData: any): Observable<any> {
    return this.http.post(`${this.URI}register`, userData);
  }

  chooseRol(userData: any): Observable<any> {
    return this.http.post(`${this.URI}rol`, userData);
  }

  checkUser(userData: any): Observable<any> {
    return this.http.post(`${this.URI}login`, userData);
  }

  logout(): Observable<any> {
    return this.http.get(`${this.URI}logout`);
  }
}
