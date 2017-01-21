import java.util.Deque;
import java.util.List;

public class Paquet {
	private Deque<Cartes> m_listeCartes;
	private int nbDistance = 46;
	private int nbAttaque = 18;
	private int nbDefense = 38;
	private int nbBotte = 4;

	
	public Paquet() {
		int i;
		for(i = 0; i < nbDistance; ++i){
			Cartes a = new Distance(i);
			m_listeCartes.add(a);
		}
		for(i = 0; i < nbAttaque; ++i){
			Cartes a = new Attaque(i);
			m_listeCartes.add(a);
		}
		for(i = 0; i < nbDefense; ++i){
			Cartes a = new Defense(i);
			m_listeCartes.add(a);
		}
		for(i = 0; i < nbBotte; ++i){
			Cartes a = new Botte(i);
			m_listeCartes.add(a);
		}
	}
	
	
	public Deque<Cartes> getM_listeCartes() {
		return m_listeCartes;
	}

}
