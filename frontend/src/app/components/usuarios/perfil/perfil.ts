import { Component, OnInit } from '@angular/core';
import { UsuarioPerfil, InfoPerfil } from '../../../common/usuarioPerfil-interface';
import { UsuarioService } from '../../../services/usuarios-service';
import { ActivatedRoute } from '@angular/router';
import { NavigationService } from '../../../services/navigation-service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-perfil',
  standalone: false,
  templateUrl: './perfil.html',
  styleUrl: './perfil.css',
})
export class Perfil implements OnInit {
  id!: string;
  isEditing: boolean = false;
  info!: InfoPerfil;
  perfil!: UsuarioPerfil;
  previousUrl!: string | null;
  atributosUsuario: string[] = [];
  atributosUsuarioAll: [] = [];
  atributosUsuarioObject: {nombre:string,icono:string}[] = [];

  constructor(
    private userService: UsuarioService,
    private activatedRoute: ActivatedRoute,
    private navigationService: NavigationService,
    private router: Router,
  ) {}

  ngOnInit(): void {
    const prevPage = this.navigationService.previousUrl;

    if (prevPage !== this.router.url) {
      this.previousUrl = prevPage;
    } else {
      this.previousUrl = '/home-estudiante';
    }

    console.log('Previous URL:', this.previousUrl);

    this.loadPerfil();
  }

  loadPerfil() {
    this.id = this.activatedRoute.snapshot.params['id'];
    console.log('hola');

    console.log(this.id);

    this.userService.getPerfilUsuario(this.id).subscribe({
      next: (respuesta) => {
        console.log('Hay perfil');
        console.log(respuesta);
        this.info = respuesta;
        this.perfil = this.info.data.perfil;
        this.atributosUsuario = this.perfil.atributos_usuario.split(';');
        console.log(this.atributosUsuario);
        this.atributosUsuario.forEach((element) => {
          const nombreA = element.split('|')[0];
          const iconoA = element.split('|')[1];
          const atributoSplit = {
            nombre:nombreA,
            icono:iconoA
          }
        this.atributosUsuarioObject.push(atributoSplit)
        });
        console.log(this.atributosUsuarioObject);
     
        
        
      },
      error: (err) => console.error('Error', err),
    });
  }

  toggleEdit() {
    this.isEditing = !this.isEditing;
  }
}
