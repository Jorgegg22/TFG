import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PerfilRegistro } from './perfil-registro';

describe('PerfilRegistro', () => {
  let component: PerfilRegistro;
  let fixture: ComponentFixture<PerfilRegistro>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PerfilRegistro]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PerfilRegistro);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
