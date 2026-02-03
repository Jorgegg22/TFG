import { Component, OnInit } from '@angular/core';
import { Atributo } from '../../../common/atributos-interface';
import { AtributoService } from '../../../services/atributos-service';
import { Router } from '@angular/router';
import { ChangeDetectorRef } from '@angular/core';
import { flush } from '@angular/core/testing';

@Component({
  selector: 'app-atributos',
  standalone: false,
  templateUrl: './atributos.html',
  styleUrls: ['./atributos.css'],
})
export class Atributos implements OnInit {
  atributos: Atributo[] = [];

  data: { userId: string | null; atributosSelected: string[] } = {
    userId: '',
    atributosSelected: [],
  };

  textoInformativo: boolean = false;

  constructor(
    private atrService: AtributoService,
    private router: Router,
    private cdr: ChangeDetectorRef,
  ) {}

  ngOnInit(): void {
    this.data.userId = localStorage.getItem('usuarioId');
    if (!this.data.userId) {
      this.router.navigate(['/login']);
    } else {
      this.loadAtributos();
    }

  }

  loadAtributos() {
    this.atrService.getAtributos().subscribe({
      next: (respuesta) => {
        this.atributos = respuesta;
        console.log(this.atributos);
        this.cdr.detectChanges();
      },
      error: (err) => console.error('Error', err),
    });
  }

  sendAtributos() {
    this.atrService.sendAtributos(this.data).subscribe({
      next: (respuesta) => {
        this.router.navigate(["/home-estudiante"])
      },
      error: (err) => console.error('Error', err),
    });
  }

  chooseAttr(event: Event, id: string) {
    let artSelected = (event.target as HTMLInputElement).checked;
    if (artSelected) {
      this.data.atributosSelected.push(id);
    } else {
      this.data.atributosSelected = this.data.atributosSelected.filter((idItem) => idItem !== id);
    }

    console.log(this.data.atributosSelected);
  }

  mostrarInfo() {
    this.textoInformativo = !this.textoInformativo;
  }
}
