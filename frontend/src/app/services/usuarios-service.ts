import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Usuario } from '../common/usuarios-interface';
import { InfoPerfil } from '../common/usuarioPerfil-interface';

@Injectable({
  providedIn: 'root',
})
export class UsuarioService {
  /* private URI: string = "http://localhost/univibe/backend/public/index.php/api/usuarios/"; */   // XAMPP
   private URI: string = 'http://localhost:8080/public/api/usuarios/'; //DOCKER

  constructor(private http: HttpClient) {}

  getUsuarios(): Observable<Usuario> {
    return this.http.get<Usuario>(this.URI);
  }

  getUsuarioById(id: any): Observable<any> {
    return this.http.post(`${this.URI}usuario`, id);
  }

  postDatosPerfi(userdata: any): Observable<any> {
    return this.http.post(`${this.URI}guardarDatos`, userdata);
  }

  getSolicitudesUsuario(userdata: any): Observable<any> {
    return this.http.post(`${this.URI}solicitudes`, userdata);
  }

  getPerfilUsuario(userId: string): Observable<InfoPerfil> {
    return this.http.get<InfoPerfil>(`${this.URI}perfil/` + userId);
  }
}
