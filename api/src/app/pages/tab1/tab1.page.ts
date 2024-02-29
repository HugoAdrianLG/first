import { Component, OnInit } from '@angular/core';
import { News} from '../../interfaces';
import { NewsService } from 'src/app/services/api.service';
import { ModalController } from '@ionic/angular';
import { ModalLoginComponent } from '../modal-login/modal-login.component';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page implements OnInit {
  public resp: News[] = [];

  news: any[] = [];

  constructor(private newsService: NewsService, private modalCtrl: ModalController)  { }

  async openModal(){
    const modal = await this.modalCtrl.create({
      component: ModalLoginComponent
    });

    await modal.present();
    console.log("¡Sí se abrió!");
  }



    ngOnInit() {
      this.newsService.getNews().subscribe((data: any) => {
        this.news = data.articles;
      });
    }


  }




