import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home-estudiante',
  standalone: false,
  templateUrl: './home-estudiante.html',
  styleUrl: './home-estudiante.css',
})
export class HomeEstudiante implements OnInit {

  options:boolean = false
  
  ngOnInit(): void {
    
  }

  showOptions(){
    this.options = !this.options
  }




}
