import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/services/api.service';
import { TopLevel } from '../../interfaces/index';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss'],
  providers: [ApiService],
})
export class Tab3Page implements OnInit {
  public resp: TopLevel[] = [];

  constructor(private newService: ApiService) {}

  ngOnInit() {
    this.newService.getTopHeadlines().subscribe(resp => {
      console.log(resp); // Imprime el objeto TopLevel o arreglo TopLevel en la consola
      if (Array.isArray(resp)) {
        this.resp = resp; // Si es un arreglo, asigna directamente
      } else {
        this.resp = [resp]; // Si es un objeto, envuélvelo en un arreglo antes de asignar
      }
    });
  }

  deleteItem(id_articulo: number) {
    console.log('Enviando solicitud DELETE para el artículo con ID:', id_articulo);

    this.newService.deleteDato(id_articulo).subscribe(
      () => {
        console.log('Solicitud DELETE completada con éxito');
        // Puedes agregar aquí cualquier lógica adicional después de la eliminación
      },
      (error) => {
        console.error('Error al enviar solicitud DELETE:', error);
        // Manejar el error adecuadamente, por ejemplo, mostrando un mensaje al usuario
      }
    );
  }


}
