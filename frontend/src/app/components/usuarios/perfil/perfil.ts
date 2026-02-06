import { Component, OnInit } from '@angular/core';
import { UsuarioPerfil, InfoPerfil } from '../../../common/usuarioPerfil-interface';
import { UsuarioService } from '../../../services/usuarios-service';
import { ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-perfil',
  standalone: false,
  templateUrl: './perfil.html',
  styleUrl: './perfil.css',
})
export class Perfil  implements OnInit{

  id!:string
  isEditing: boolean = false;
  info!:InfoPerfil
  perfil!:UsuarioPerfil

  constructor(
    private userService: UsuarioService,
    private activatedRoute:ActivatedRoute

  ) {}
  
  ngOnInit(): void {
    this.loadPerfil();
  }



  loadPerfil(){
    this.id = this.activatedRoute.snapshot.params['id'];
    console.log(this.id);
    
    this.userService.getPerfilUsuario(this.id).subscribe({
      next: (respuesta) => {
        console.log("Hay perfil");
        console.log(respuesta);
        this.info = respuesta
        this.perfil = this.info.data.perfil
      
        
        
        
        
        
        
        
      },
      error: (err) => console.error('Error', err),
    });

  }



toggleEdit() {
 this.isEditing = !this.isEditing
}

}
