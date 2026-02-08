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
  atributosUsuarioObject: { nombre: string; icono: string }[] = [];
  loading:boolean = true;

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

  this.userService.getPerfilUsuario(this.id).subscribe({
    next: (respuesta) => {
      this.info = respuesta;
      this.perfil = this.info.data.perfil;
      
      this.atributosUsuarioObject = [];
      if (this.perfil.atributos_usuario) {
        this.atributosUsuario = this.perfil.atributos_usuario.split(';');
        this.atributosUsuario.forEach((element) => {
          const partes = element.split('|');
          if (partes.length === 2) {
            this.atributosUsuarioObject.push({
              nombre: partes[0],
              icono: partes[1]
            });
          }
        });
      }
      this.loading = false
    },
    error: (err) => console.error('Error al cargar perfil', err)
  });
}

  toggleEdit() {
    this.isEditing = !this.isEditing;
  }
}
