import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from '../common/usuarios-interface';
import { InfoPerfil } from '../common/usuarioPerfil-interface';
import { SolicitudesPropietarioResponse } from '../common/solicitudesPropietario-interface';
import { ListaInmuebles } from '../common/inmuebles-interface';

@Injectable({
  providedIn: 'root',
})
export class PropietarioService {
  //private URI: string = 'http://localhost/univibe/backend/public/index.php/api/propietarios/'; // XAMPP
  private URI: string = 'http://localhost:8080/api/propietarios/'; //DOCKER

  constructor(private http: HttpClient) {}

  getUsuarioByToken(): Observable<Usuario> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };
    return this.http.get<Usuario>(`${this.URI}usuario`, httpOptions);
  }

  postDatosPerfi(userdata: any): Observable<any> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };
    return this.http.post(`${this.URI}guardarDatos`, userdata, httpOptions);
  }

  getSolicitudesPropietario(): Observable<SolicitudesPropietarioResponse> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };

    return this.http.get<SolicitudesPropietarioResponse>(`${this.URI}solicitudes`, httpOptions);
  }

  getInmueblesPropietario(): Observable<ListaInmuebles> {
    const sesionStr = localStorage.getItem('sesion');
    const sesionObj = JSON.parse(sesionStr || '{}');

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(sesionObj.token || ''),
      }),
    };
    return this.http.get<ListaInmuebles>(`${this.URI}inmuebles`, httpOptions);
  }

  getPerfilUsuario(userId?: string): Observable<InfoPerfil> {
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

    if (!userId) {
      return this.http.get<InfoPerfil>(`${this.URI}perfil`, httpOptions);
    } else {
      return this.http.get<InfoPerfil>(`${this.URI}perfil/` + userId, httpOptions);
    }
  }

  postInmueble(inmData: any): Observable<any> {
    const sesionStr = localStorage.getItem('sesion');
    //Convertimos en objeto sesionStr,para acceder al token
    const sesionObj = JSON.parse(sesionStr || '{}');
    const token = sesionObj.token;

    const httpOptions = {
      headers: new HttpHeaders({
        'X-API-TOKEN': String(token),
      }),
    };

    return this.http.post<any>(`${this.URI}publicar`, inmData, httpOptions);
  }

  deleteInmueble(id: string): Observable<any> {
    return this.http.post<any>(`${this.URI}eliminar`, { id });
  }
}
