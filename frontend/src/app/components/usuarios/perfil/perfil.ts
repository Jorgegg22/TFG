import { Component, OnInit } from '@angular/core';
import { UsuarioPerfil,InfoPerfil } from '../../../common/usuarioPerfil-interface';
import { UsuarioService } from '../../../services/usuarios-service';

@Component({
  selector: 'app-perfil',
  standalone: false,
  templateUrl: './perfil.html',
  styleUrl: './perfil.css',
})
export class Perfil  implements OnInit{

  id!:string  | null 
  isEditing: boolean = false;
  info!:InfoPerfil
  perfil!:UsuarioPerfil

  constructor(private userService: UsuarioService) {}
  
  ngOnInit(): void {
    this.id = localStorage.getItem("usuarioId");
    this.loadPerfil();
  }



  loadPerfil(){
    this.userService.getPerfilUsuario(this.id).subscribe({
      next: (respuesta) => {
        console.log("Hay perfil");
        this.info = respuesta;
        this.perfil = this.info.data.perfil
        console.log(this.perfil);
        
        
        
        
      },
      error: (err) => console.error('Error', err),
    });

  }



toggleEdit() {
 this.isEditing = !this.isEditing
}

}
