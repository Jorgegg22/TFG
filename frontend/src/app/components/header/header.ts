import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';
import { UsuarioService } from '../../services/usuarios-service';
import { UsuarioPerfil,InfoPerfil } from '../../common/usuarioPerfil-interface';
import { Perfil } from '../usuarios/perfil/perfil';


@Component({
  selector: 'app-header',
  standalone: false,
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header implements OnInit {
  userId!: string | null;
  options: boolean = false;
  info!:InfoPerfil
  perfil!:UsuarioPerfil;

  urlImagenes = 'http://localhost:8080/uploads/perfiles/';

   constructor(
    private authService:AuthService,
    private userService:UsuarioService,
    private router:Router,

   ){}

  ngOnInit(): void {
    this.loadPerfil()
  }

  loadPerfil(){
    this.userService.getPerfilUsuario().subscribe({
      next:(respuesta) =>{
        console.log(respuesta);
        this.info = respuesta;
        this.perfil = this.info.data.perfil
        if(this.perfil.foto_perfil === "avatar_default.png"){
          this.urlImagenes = './assets/img/'
        }

    

        
      }
    })
  }

  showOptions() {
    this.options = !this.options;
  };

  logout(){
    this.authService.logout().subscribe({
      next:(respuesta) => {
        localStorage.removeItem('sesion');
        this.router.navigate(['/login']);
      }
    })
  };



}
