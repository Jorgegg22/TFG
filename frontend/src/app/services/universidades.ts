import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Universidad } from '../common/universidades-interface';

@Injectable({
  providedIn: 'root'
})
export class UniversidadesS {
  private URI: string = "http://localhost/univibe/backend/public/index.php/api/universidades";

  constructor(private http: HttpClient) {
   
  }

  getUniversidades(): Observable<Universidad[]>{
    return this.http.get<Universidad []>(this.URI);
  }
  



}

