<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Recipes | Data </title>
        <link rel="stylesheet" type="text/css" href="recipes.css"/>
      </head>
      <body>
        <div class="container">
          <div class="col-sm-12">
            <br/>
              <div class="row">
                <h1>Recipes</h1>
              </div>
            </div> 
          <div class="row">
              <div class="col-sm-12 text-primary">
                <h2>Data Sorted By Recipe Name</h2>
              </div>
              <div class="col-sm-12">  
                <table  class="table table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>Recipe Id</th>
                      <th>Recipe Name</th>
                      <th>Total Time</th>
                      <th>status</th>
                      <th>Upper Time</th>
                      <th>LowerTime</th>
                    </tr>
                  </thead>
                   <tbody>
                    <xsl:for-each select="recipes/recipeData">
                       <xsl:sort select="recipeName" order="ascending"/> 
                      <tr>
                        <td><xsl:value-of select="@id"/></td>
                         <td><xsl:value-of select="recipeName"/></td>
                           <td><xsl:value-of select="time/@totalTime"/> min </td>
                          <xsl:if test="time/@totalTime &gt; 60">
                            <td>Slow Burner</td>
                          </xsl:if>
                          <xsl:if test="time/@totalTime &gt;=30 and time/@totalTime &lt;60">
                            <td>Medium Burner</td>
                          </xsl:if>
                          <xsl:if test="time/@totalTime &lt; 30">
                            <td>Fast Burner</td>
                          </xsl:if>

                           <td><xsl:value-of select="time/upperEstimate"/></td>
                            <td><xsl:value-of select="time/lowerEstimate"/></td>
                      </tr>  
                      
                    </xsl:for-each>
                  </tbody>
              </table>
          </div>
        </div>
        <br/><br/>
        <div class="row">
              <div class="col-sm-12 text-success">
                <h2>Data Sorted By Total Time take by Recipe</h2>
              </div>
              <div class="col-sm-12">  
                <table  class="table table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>Recipe Id</th>
                      <th>Recipe Name</th>
                      <th>Total Time</th>
                      <th>status</th>
                      <th>Upper Time</th>
                      <th>LowerTime</th>
                    </tr>
                  </thead>
                   <tbody>
                    <xsl:for-each select="recipes/recipeData">
                       <xsl:sort select="time/@totalTime" data-type="number" order="ascending"/> 
                      <tr>
                        <td><xsl:value-of select="@id"/></td>
                         <td><xsl:value-of select="recipeName"/></td>
                           <td><xsl:value-of select="time/@totalTime"/> min </td>
                          <xsl:if test="time/@totalTime &gt; 60">
                            <td>Slow Burner</td>
                          </xsl:if>
                          <xsl:if test="time/@totalTime &gt;=30 and time/@totalTime &lt;60">
                            <td>Medium Burner</td>
                          </xsl:if>
                          <xsl:if test="time/@totalTime &lt; 30">
                            <td>Fast Burner</td>
                          </xsl:if>

                           <td><xsl:value-of select="time/upperEstimate"/></td>
                            <td><xsl:value-of select="time/lowerEstimate"/></td>
                      </tr>  
                      
                    </xsl:for-each>
                  </tbody>
              </table>
          </div>
        </div>
         <br/><br/>
        <div class="row">
              <div class="col-sm-12 text-success">
                <h2>All Data</h2>
              </div>
              <div class="col-sm-12">  
                <table  class="table table-bordered table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>Recipe Id</th>
                      <th>Recipe Name</th>
                      <th>Total Time</th>
                      <th>status</th>
                      <th>Upper Time</th>
                      <th>LowerTime</th>
                    </tr>
                  </thead>
                   <tbody>
                    <xsl:for-each select="recipes/recipeData">
                       <xsl:sort select="recipeName" data-type="text" order="ascending"/> 
                      <tr class="bg-primary text-white">
                        <td ># <xsl:value-of select="@id"/></td>
                         <td><xsl:value-of select="recipeName"/></td>
                           <td><xsl:value-of select="time/@totalTime"/> min </td>
                          <xsl:if test="time/@totalTime &gt; 60">
                            <td>Slow Burner</td>
                          </xsl:if>
                          <xsl:if test="time/@totalTime &gt;=30 and time/@totalTime &lt;60">
                            <td>Medium Burner</td>
                          </xsl:if>
                          <xsl:if test="time/@totalTime &lt; 30">
                            <td>Fast Burner</td>
                          </xsl:if>

                           <td><xsl:value-of select="time/upperEstimate"/></td>
                            <td><xsl:value-of select="time/lowerEstimate"/></td>
                      </tr>  
                      <xsl:for-each select="nutritionPerServing/nutrition">
                       <tr class="bg-danger text-white">
                         <td><xsl:value-of select="position()"/></td>
                         <td>Nutrition</td> 
                          <td colspan="4"><xsl:value-of select="valueOf"/></td>
                       </tr> 
                     </xsl:for-each>
                     <xsl:for-each select="ingredients/ingredient">
                       <tr class="bg-success text-white">
                         <td><xsl:value-of select="position()"/></td> 
                          <td>Ingredient</td> 
                          <td colspan="4"><xsl:value-of select="valueOf"/></td>
                       </tr> 
                     </xsl:for-each>
                     <xsl:for-each select="method/step">
                       <tr class="bg-warning text-white">
                         <td><xsl:value-of select="position()"/></td> 
                           <td>Step</td> 
                          <td colspan="4"><xsl:value-of select="valueOf"/></td>
                       </tr> 
                     </xsl:for-each>
                   </xsl:for-each>
                  </tbody>
              </table>
          </div>
        </div>
      </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>  