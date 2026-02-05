import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-header',
  standalone: false,
  templateUrl: './header.html',
  styleUrl: './header.css',
})
export class Header implements OnInit {

  userId!:string | null
  
  ngOnInit(): void {
    this.userId = localStorage.getItem("usuarioId")
  }

}
