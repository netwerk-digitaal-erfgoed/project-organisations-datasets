package com.metamatter.nde;

import java.io.File;

public class CNLParameters {
	
	public CNLParameters(){
		
	}
	
	private String encoding, endpoint , prefixURL , prefixURI, nameRegistry, sparql ;
	private File fileOut ;
		
	public String getEncoding(){
		return this.encoding;
	}
	public void setEncoding(String value){
		this.encoding = value ;
	}

	public String getRegistry(){
		return this.endpoint;
	}
	public void setRegistry(String value){
		this.endpoint = value ;
	}

	public String getPrefixURL(){
		return this.prefixURL;
	}
	public void setPrefixURL (String value){
		this.prefixURL = value ;
	}

	public String getPrefixURI(){
		return this.prefixURI;
	}
	public void setPrefixURI (String value){
		this.prefixURI = value ;
	}
	
	public File getFileOut(){
		return this.fileOut;
	}
	public void setFileOut (String value){
		this.fileOut = new File(value) ;
	}

	public String getNameRegistry(){
		return this.nameRegistry;
	}
	public void setNameRegistry (String value){
		this.nameRegistry = value ;
	}

	public String getSPARQL(){
		return this.sparql;
	}
	public void setSPARQL (String value){
		this.sparql = value ;
	}

}
