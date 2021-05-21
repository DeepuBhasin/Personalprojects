<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Londan Transit Shop</title>
        <style>

          h1,h3{font-family:calibri;}
          table{width:1000px;
            border:solid 1px black;
            
          }
          th{background-color:lightgrey;}
          td{border:solid 2px lightgrey;}
        </style>
      </head>
      <body>
        <h1>Transit Stop in Londan, Ontario</h1>
        <h3>Enter a route number and /or street, or leave blank</h3>
        Route Number <input type="text" name="routeNumber" id="routeNumber" class="routeNumber"/>  &#160;  &#160;
        Street Name <input type="text" name="streetName" id="streetName" class="streetName"/> &#160; &#160;
         <input type="button" value="Update" id="updateButton"/>
       <div id="routeDetails" style="display:none;">
          <p><h1 id="headingOfStop">All Stops</h1></p>
          
          <p><h3 id="noOfStop"><xsl:value-of select="count(london-transit-data/stop)"/> Stop Found</h3></p>
      
       <table id="myTable">
        <thead>
          <tr>
            <th>Stop #</th>
            <th>Stop Name</th>
            <th>Longitude</th>
             <th>Longitude</th>
            <th>Routes</th>
          </tr>
        </thead>
        <tbody>
          <xsl:for-each select="london-transit-data/stop">
          <xsl:sort select="@id" order="ascending"/> 
          <tr>
            <td><xsl:value-of select="@id"/></td>
            <td><xsl:value-of select="@name"/></td>
            <td><xsl:value-of select="location/@lattitude"/></td>
            <td><xsl:value-of select="location/@longitude"/></td>
            <td><xsl:value-of select="routes"/></td>
           
          </tr>
          </xsl:for-each>
        </tbody>
       </table>
        </div>
       <script src="myscripts.js"></script>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>  