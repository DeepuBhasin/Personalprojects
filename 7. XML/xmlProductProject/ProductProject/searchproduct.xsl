<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Book Store</title>
        <link rel="stylesheet" href="css/style.css"/>
      </head>
      <body>
        <header>
          <a href="searchproduct.xml">Search Books</a> 
          <a href="allproducts.xml">All Books</a>
        </header>
        <h1>Book Store</h1>
        <h3>Enter a Book code or leave blank</h3>
        Book Code <input type="text" name="bookCode" id="bookCode" class="bookCode"/>  &#160;  &#160;
        <input type="button" value="Search" id="search"/>
        <div id="routeDetails" style="display:none;">
          
          
          <p><h3 id="noOfBooks"><xsl:value-of select="count(products/book)"/> Book Found</h3></p>
      
       <table id="myTable">
        <thead>
          <tr>
            <th>Code</th>
            <th>Category</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            

          </tr>
        </thead>
        <tbody>
          <xsl:for-each select="products/book">
           
          <tr>
            <td><xsl:value-of select="@code"/></td>
            <td><xsl:value-of select="category"/></td>
            <td><xsl:value-of select="name"/></td>
            <td><xsl:value-of select="description"/></td>
            <td><xsl:value-of select="quantity"/></td>
            <td><xsl:value-of select="unitPrice"/></td>
           
          </tr>
          </xsl:for-each>
        </tbody>
       </table>
        </div>
       <script src="js/scripts.js"></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>  