import { Component, OnInit } from '@angular/core';
import { News} from '../../interfaces';
import { NewsService } from 'src/app/services/api.service';
import {NavController } from '@ionic/angular';
import { AngularFireAuth } from '@angular/fire/compat/auth';


@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page implements OnInit {
  public resp: News[] = [];

  news: any[] = [];

  isUserLoggedIn: boolean = false;
  userDisplayName: string = '';

  constructor(
    private newsService: NewsService,
    private navCtrl : NavController,
    private afAuth: AngularFireAuth,

    )  {
      this.afAuth.authState.subscribe(user => {
          if (user) {
            this.isUserLoggedIn = true;
            this.userDisplayName = user.displayName || user.email || ''; // Actualiza userDisplayName con el username o email del usuario
          } else {
            this.isUserLoggedIn = false;
            this.userDisplayName = ''; // Reinicia userDisplayName si el usuario no está autenticado
          }
        });

    }

  openLoginPage() {
    this.navCtrl.navigateForward('/login');
  }

    ngOnInit() {
      this.newsService.getNews().subscribe((data: any) => {
        this.news = data.articles;
      });
    }

    ionViewWillEnter() {
      this.initializeAuthentication();
    }

    initializeAuthentication() {
      this.afAuth.authState.subscribe(user => {
        this.isUserLoggedIn = !!user;
        this.userDisplayName = user?.displayName || '';
      });
    }

    async logout() {
      await this.afAuth.signOut(); // Cierra la sesión
      this.navCtrl.navigateRoot(''); // Navega de vuelta a la página de inicio u otra página adecuada
    }

    navigateToPage(pageUrl: string) {
      this.navCtrl.navigateRoot(''); // Navega a la página especificada
    }


  }




