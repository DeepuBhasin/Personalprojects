<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>All Products Store</title>
        <link rel="stylesheet" href="css/style.css"/>
      </head>
      <body>
        <header>
          <a href="searchproduct.xml">Search Books</a> 
          <a href="allproducts.xml">All Books</a>
        </header>
        <h1>Book Store</h1>
        <div id="routeDetails" style="display:block;">
          <p><h1 id="headingOfStop">All Books</h1></p>
           <table id="myTable">
            <thead>
              <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
              </tr>
            </thead>
            <tbody>
              <xsl:for-each select="products/book">
              <tr>
                <td><xsl:value-of select="@code"/></td>
                <td><xsl:value-of select="name"/></td>
                <td><xsl:value-of select="quantity"/></td>
                <td><xsl:value-of select="unitPrice"/></td>
               
              </tr>
              </xsl:for-each>
            </tbody>
           </table>
         </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>  