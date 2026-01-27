import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Atributos } from './atributos';

describe('Atributos', () => {
  let component: Atributos;
  let fixture: ComponentFixture<Atributos>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [Atributos]
    })
    .compileComponents();

    fixture = TestBed.createComponent(Atributos);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
