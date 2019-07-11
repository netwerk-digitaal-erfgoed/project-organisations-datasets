package com.metamatter.nde;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;

import org.apache.commons.configuration2.Configuration;
import org.apache.commons.configuration2.builder.fluent.Configurations;
import org.apache.commons.configuration2.ex.ConfigurationException;
import org.apache.commons.io.FileUtils;
import org.apache.jena.query.*;
import org.apache.jena.rdf.model.Model;
import org.apache.jena.rdf.model.ModelFactory;

import com.metamatter.util.Prefix;
import com.metamatter.util.QueryEndpoint;
import com.metamatter.util.Triples;

public class CNLHarvester {

	/**
	 * POC code for a harvester of metadata from Collectie Nederland
	 * Author: Roland Cornelissen
	 * Date: v0.1 19-6-2019
	 */

		
	private static CNLParameters parameters = new CNLParameters();

	
	public static void main(String[] args) throws ConfigurationException, IOException {

		if (args.length < 1) {
			System.out.println("The file containing configuration parameters must be provided as a parameter to the program");
			System.exit(1);
		} 

		String triples = "";
		File configFile = new File(args[0]);
		Configurations configs = new Configurations();
		Configuration config = configs.properties(configFile);
		
		for (int i=1; i <= config.getInt("registry.count"); i++) {
			parameters.setRegistry(config.getString(i+".registry"));
			parameters.setPrefixURI(config.getString(i+".prefixURI"));
			parameters.setFileOut(config.getString(i+".fileOut"));
			parameters.setNameRegistry(config.getString(i+".nameRegistry"));
			parameters.setSPARQL(config.getString(i+".sparql"));
			
			ResultSet results = QueryEndpoint.queryRS(parameters.getSPARQL(), parameters.getRegistry()) ;
			System.out.println(parameters.getRegistry());

			// create triples for the Registry entity and parse metadata to triples
			String uriReg = Triples.URI(parameters.getPrefixURI(), parameters.getNameRegistry()); 
			triples += Triples.tripleO(uriReg, Prefix.rdf + "type", Prefix.nde + "Registry");
			triples += Triples.tripleL(uriReg, Prefix.rdfs + "label", parameters.getNameRegistry(), null);

			for (; results.hasNext();) {
				QuerySolution row = results.next();
				
				System.out.println(row.getResource("s"));
				String id = row.getResource("s").toString();
				String uri = parameters.getPrefixURI()+ id.substring(id.lastIndexOf("/")+1);
				triples += Triples.tripleL(uri, Prefix.nde + "identifier", id.substring(id.lastIndexOf("/")+1) , null); 
				triples += Triples.tripleL(uri, Prefix.nde + "title", row.getLiteral("n").toString() , null); 
				triples += Triples.tripleO(uri, Prefix.nde + "datasetOf", uriReg);
				triples += Triples.tripleO(uri, Prefix.rdf + "type", Prefix.nde + "Dataset");
				triples += Triples.tripleO(uri, Prefix.nde + "source", row.getResource("s").toString() );
				if (row.contains("r")) { triples += Triples.tripleO(uri, Prefix.nde + "licenseOfContents", row.getLiteral("r").toString() ); }
				if (row.contains("d")) { triples += Triples.tripleL(uri, Prefix.nde + "description", row.getLiteral("d").toString(), null ); }
				if (row.contains("t")) { triples += Triples.tripleL(uri, Prefix.nde + "harvestType", row.getLiteral("t").toString(), null ); }
				if (row.contains("o")) { 
					String orgURI = Triples.URI(parameters.getPrefixURI() , row.getLiteral("o").toString() );
					triples += Triples.tripleO(uri, Prefix.nde + "owner", orgURI );
					triples += Triples.tripleL(orgURI, Prefix.nde + "title", row.getLiteral("o").toString(), null );
					triples += Triples.tripleO(orgURI, Prefix.rdf + "type", Prefix.foaf + "Organization");
				}

			}
			// System.out.println(triples);
			// write triples to file
	    FileUtils.writeStringToFile(parameters.getFileOut(), triples , "ISO-8859-1");
	    triples = "";

		}
	
	}

}
