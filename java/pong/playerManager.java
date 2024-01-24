import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import java.util.*;

public class playerManager extends Thread implements KeyListener{
	JLabel player,avversario,palla;
	int input;
	boolean dirX;
	int dirY;
	
	public playerManager(JLabel player,JLabel avversario,JLabel palla){
		//copia tutti gli elementi da gestire
		this.player=player;
		this.avversario=avversario;
		this.palla=palla;
		//valore nullo per la direzione
		input=0;
		dirY=1;
	}
	//ridefinizione metodi per il keylistener
	@Override
	public void keyReleased(KeyEvent k){
		//resetta il tasto
		input=0;
	}
	@Override
	public void keyPressed(KeyEvent k){
		//leggi il tasto
		input=k.getKeyCode();
	}
	@Override
	public void keyTyped(KeyEvent k){
		//leggi il tasto
		input=k.getKeyCode();
	}
	//metodo run, viene eseguito con l'avvio del thread
	public void run(){
		while(true){
			try{
				//gestisci posizione giocatore e avversario
				//prendi la posizione di y dei player
				Point posPlayer=player.getLocation();
				int nuovoYpl=(int)posPlayer.getY();
				//controlla cosa sta premendo l'utente
				if(input==KeyEvent.VK_UP && nuovoYpl>0)
					//sali se il giocatore preme freccia su e non sta uscendo fuori bound
					nuovoYpl--;
				if(input==KeyEvent.VK_DOWN && nuovoYpl<400-100)
					//scendi se il giocatore preme freccia giù e non sta uscendo fuori bound
					nuovoYpl++;
				//imposta la direzione calcolata, x non deve mai variare
				//quella dell'avversario verrà alla fine
				
				player.setLocation(0,nuovoYpl);
				
				//gestisci movimento palla
				//prendi posizione palla (sia x e y)
				Point posPalla=palla.getLocation();
				int nuovoY=(int)posPalla.getY();
				int nuovoX=(int)posPalla.getX();
				//controlla se la palla ha rimbalzato sul muro
				if(nuovoY==0 || nuovoY==(400-26)){
					//falla andare nella direzione opposta
					if(dirY==1)
						dirY=-1;
					else dirY=1;
				}
				//controlla se la palla ha rimbalzato sulla racchetta (player)
				if(nuovoX==0+20){
					//il player ha preso la palla?
					int tmpPos=nuovoYpl-nuovoY+100-13;
					if(tmpPos>=0 && tmpPos<=100){
						//controlla in quale punto l'ha presa e decidi come deve rimbalzare
						//in alto
						if(tmpPos<35)
							dirY=1;
						//in basso
						else if(tmpPos>65)
							dirY=-1;
						//in mezzo
						else dirY=0;
					}
					else{//se non l'ha presa chiudi il programma
						System.out.println("Hai perso");
						System.exit(0);
					}
					dirX=!dirX;
				}
				//controlla se la palla ha rimbalzato sulla racchetta (avversario)
				if(nuovoX==800-20-26){
					Random r=new Random();
					dirY=r.nextInt(3)-1;
					dirX=!dirX;
				}
				//usa i dati ottenuti per capire la direzione che deve prendere la palla
				//direzione verticale
				if(dirX==true)
					nuovoX++;
				else
					nuovoX--;
				//direzione orizzontale
				nuovoY+=dirY;
				palla.setLocation(nuovoX,nuovoY);
				//impostazione posizione avversario
				avversario.setLocation((800-20),nuovoY-(50-13));
				sleep(2);
			}
			catch(InterruptedException ex){
				//non dovrebbe mai succedere?
			}
		}
	}
}