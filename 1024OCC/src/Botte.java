
public class Botte extends Cartes{
	private String m_type;
	private enum m_eType {
		As, 
		Citerne,
		Increvable,
		Prioritaire
	};

	public String getM_type() {
		return m_type;
	}

	public void setM_type(String m_type) {
		this.m_type = m_type;
	}
}
