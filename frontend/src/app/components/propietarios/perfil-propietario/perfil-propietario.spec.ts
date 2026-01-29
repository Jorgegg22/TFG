import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PerfilPropietario } from './perfil-propietario';

describe('PerfilPropietario', () => {
  let component: PerfilPropietario;
  let fixture: ComponentFixture<PerfilPropietario>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PerfilPropietario]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PerfilPropietario);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
