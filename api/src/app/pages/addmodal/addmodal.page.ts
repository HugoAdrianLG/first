import { Component, OnInit } from '@angular/core';
import { TopLevel } from 'src/app/interfaces';
import { ApiService } from 'src/app/services/api.service';

@Component({
  selector: 'app-addmodal',
  templateUrl: './addmodal.page.html',
  styleUrls: ['./addmodal.page.scss'],
})
export class AddmodalPage {
    articulo?:        string;
     imagen?:          string;
     descripcion?:     string;

   constructor(private apiService: ApiService) {}

   enviarDatos() {
     const datos: TopLevel = {
       id_articulo: -1,
       articulo: this.articulo,
       imagen: this.imagen,
       descripcion: this.descripcion,
     };

    this.apiService.postDatos(datos).subscribe(resp => {
      console.log(resp);
    });
  }

}
