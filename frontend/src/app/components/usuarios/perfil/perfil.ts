import { Component } from '@angular/core';

@Component({
  selector: 'app-perfil',
  standalone: false,
  templateUrl: './perfil.html',
  styleUrl: './perfil.css',
})
export class Perfil {

  isEditing: boolean = false;



toggleEdit() {
 this.isEditing = !this.isEditing
}

}
