import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { News, TopLevel } from '../interfaces';
import { map } from 'rxjs/operators';
import { ModalController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  public apiUrl = 'http://127.0.0.1:80/api1/method.php'; // Reemplaza con la URL de tu API

  constructor(private http: HttpClient) {}

  // Método para obtener los datos
  getTopHeadlines(): Observable<TopLevel[]> {
    return this.http.get<TopLevel[]>(this.apiUrl);
  }

  // Método para enviar datos por POST
  postDatos(datos: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, datos);
  }

  deleteDato(id_articulo: number): Observable<any> {
    const url = `${this.apiUrl}?id=${id_articulo}`;
    return this.http.delete<any>(url);
  }
}

@Injectable({
  providedIn: 'root'
})
export class NewsService {
  apiKey = '1cad9c0a754e4d928cd8e9c51558b258';

  constructor(private http: HttpClient) { }

  getNews() {
    return this.http.get<News>(`https://newsapi.org/v2/everything?q=anime video games&language=es&apiKey=${this.apiKey}`);
  }
}


