import { ComponentFixture, TestBed } from '@angular/core/testing';
import { UpdatemodalPage } from './updatemodal.page';

describe('UpdatemodalPage', () => {
  let component: UpdatemodalPage;
  let fixture: ComponentFixture<UpdatemodalPage>;

  beforeEach(async(() => {
    fixture = TestBed.createComponent(UpdatemodalPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
