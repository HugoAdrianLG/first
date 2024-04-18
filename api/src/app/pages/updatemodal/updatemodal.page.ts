import { Component, OnInit } from '@angular/core';
import { TopLevel } from 'src/app/interfaces';
import { ApiService } from 'src/app/services/api.service';

@Component({
  selector: 'app-updatemodal',
  templateUrl: './updatemodal.page.html',
  styleUrls: ['./updatemodal.page.scss'],
})
export class UpdatemodalPage {
  id_articulo ?:    number;
  articulo?:        string;
  imagen?:          string;
  descripcion?:     string;

constructor(private apiService: ApiService) {}

enviarDatos() {
  const datos: TopLevel = {
    id_articulo: this.id_articulo,
    articulo: this.articulo,
    imagen: this.imagen,
    descripcion: this.descripcion,
  };

 this.apiService.patchDatos(datos).subscribe(resp => {
   console.log(resp);
 });
}





}
