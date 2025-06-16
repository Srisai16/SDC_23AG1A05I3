package Experiment06;
import java.io.File;
import javax.xml.XMLConstants;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.transform.stream.StreamSource;
import javax.xml.validation.*;
import org.xml.sax.SAXException;

public class XMLValidator {

    public static void main(String[] args) {
        validateWithDTD("bookstore_dtd.xml");
        validateWithXSD("bookstore_xsd.xml", "bookstore.xsd");
    }

    private static void validateWithDTD(String xmlFile) {
        try {
            DocumentBuilderFactory factory = DocumentBuilderFactory.newInstance();
            factory.setValidating(true);
            factory.setNamespaceAware(true);

            DocumentBuilder builder = factory.newDocumentBuilder();
            builder.setErrorHandler(new org.xml.sax.helpers.DefaultHandler());
            builder.parse(new File(xmlFile));

            System.out.println("✅ DTD Validation: Successful");
        } catch (Exception e) {
            System.out.println("❌ DTD Validation failed: " + e.getMessage());
        }
    }

    private static void validateWithXSD(String xmlFile, String xsdFile) {
        try {
            SchemaFactory factory = SchemaFactory.newInstance(XMLConstants.W3C_XML_SCHEMA_NS_URI);
            Schema schema = factory.newSchema(new File(xsdFile));
            Validator validator = schema.newValidator();
            validator.validate(new StreamSource(new File(xmlFile)));

            System.out.println("✅ XSD Validation: Successful");
        } catch (SAXException e) {
            System.out.println("❌ XSD Validation failed: " + e.getMessage());
        } catch (java.io.IOException e) {
            System.out.println("❌ XSD Validation failed: " + e.getMessage());
        }
    }
}
