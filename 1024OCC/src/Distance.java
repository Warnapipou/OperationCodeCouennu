
public class Distance extends Cartes {
	private int m_type;
	private int nb25 = 10;
	private int nb50 = 10;
	private int nb75 = 10;
	private int nb100 = 12;
	private int nb200 = 4;
	

	Distance(int i){
		m_type = 25;
	}
	
	
	public int getM_type() {
		return m_type;
	}

	public void setM_type(int m_type) {
		this.m_type = m_type;
	}
	
}
