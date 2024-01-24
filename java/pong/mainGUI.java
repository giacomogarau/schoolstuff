import javax.swing.*;
import java.awt.*;

public class mainGUI{
	public static void main(String args[]){
		//asset del gioco
		ImageIcon playerImg=new ImageIcon("assets/racchetta.png");
		ImageIcon sfondoImg=new ImageIcon("assets/tavolo.png");
		ImageIcon pallaImg=new ImageIcon("assets/palla.png");
		
		//finestra di gioco
		//crea finestra
		JFrame finestra=new JFrame("Pong");
		//chiuderla chiude tutto il programma
		finestra.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		//non voglio un layout predefinito
		finestra.setLayout(null);
		//imposta la dimensione della finestra, escludendo i bordi
		Container c=finestra.getContentPane();
		c.setPreferredSize(new Dimension(800,400));
		//blocca le dimensioni
		finestra.setResizable(false);
		//rendi la finestra visibile
		finestra.setVisible(true);
		
		//configurazione sfondo
		//crea sfondo
		JLabel sfondo=new JLabel(sfondoImg);
		//imposta la dimensione
		sfondo.setSize(800,400);
		//aggiungo lo sfondo alla fine
		
		//configurazione player (giocatore)
		//crea player
		JLabel player=new JLabel(playerImg);
		//imposta la sua dimensione
		player.setSize(20,100);
		player.setBounds(0,0,20,100);
		//imposta la sua posizione
		player.setLocation(0,(200-50));
		//aggiungi il player alla finestra
		finestra.add(player);
		
		//configurazione player (avversario)
		//crea avversario
		JLabel avversario=new JLabel(playerImg);
		//imposta la sua dimensione
		avversario.setSize(20,100);
		avversario.setBounds(0,0,20,100);
		//imposta la sua posizione
		avversario.setLocation((800-20),(200-50));
		//aggiungi il player alla finestra
		finestra.add(avversario);
		
		//configurazione palla
		//crea palla
		JLabel palla=new JLabel(pallaImg);
		//imposta la sua dimensione
		palla.setSize(26,26);
		palla.setBounds(0,0,26,26);
		//imposta la sua posizione
		palla.setLocation((400-13),(200-13));
		//aggiungi la palla alla finestra
		finestra.add(palla);
		
		//gestore dei due player
		playerManager gestore=new playerManager(player,avversario,palla);
		//avvia thread (per ascoltare i tasti)
		gestore.start();
		//avvia il KeyListener
		finestra.addKeyListener(gestore);
		
		//aggiungi sfondo alla finestra (lo faccio qui per farla apparire dietro)
		finestra.add(sfondo);
		//obbligatorio
		finestra.pack();
		finestra.validate();
	}
}