<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Patient | Insurance | Data </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
      </head>
      <body>
        <div class="container">
          <div class="row">
            <br/>
          </div>
         <div class="row text-dark">
            <h1>Electrical Medical Record</h1>
          </div>
          <div class="row text-primary">
            <h2>Patient Information And Insurance Company Data</h2>
          </div>
          <div class="row text-success">
            <h3>Patient Information</h3>
          </div>
          <div class="row">  
            <table  class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th>Age</th>
                  <th>Weight</th>
                  <th>Treatment</th>
                  <th>Medication</th>
                  <th>Allergies</th>
                  
                 </tr>
              </thead>
               <tbody>
                <xsl:for-each select="data/electricalMedicalRecord/patientInfromation">
                <xsl:sort select="@id" order="ascending"/> 
                  <tr class="bg-success">
                    <td><xsl:value-of select="position()"/> ) <xsl:value-of select="personalInfromation/userId"/></td>
                    <td><xsl:value-of select="personalInfromation/FirstName"/></td>
                    <td><xsl:value-of select="personalInfromation/lastName"/></td>
                    <td><xsl:value-of select="personalInfromation/gender"/></td>
                    <td><xsl:value-of select="personalInfromation/address"/></td>
                    <td><xsl:value-of select="personalInfromation/age"/></td>
                    <td><xsl:value-of select="personalInfromation/weight"/></td>
                    <td><xsl:value-of select="MedicalInfromation/TreatmentOf"/>(<xsl:value-of select="MedicalInfromation/subCategory"/>)</td>
                    <td><xsl:value-of select="MedicalInfromation/medication"/></td>
                    <td><xsl:value-of select="MedicalInfromation/allergies"/></td>
                  </tr>
                  <tr>  
                    <td>Immunization Status: <xsl:value-of select="MedicalInfromation/immunizationStatus"/></td>
                    <td>Consultations No. : <xsl:value-of select="MedicalInfromation/medicalHistory/consultations"/></td>
                    <td>Surgeries No : <xsl:value-of select="MedicalInfromation/medicalHistory/surgeries"/></td>
                    <td>Laboraroty Test Results : <xsl:value-of select="MedicalInfromation/medicalHistory/LaborarotyTestResults"/></td>
                    <td>Bank : <xsl:value-of select="MedicalInfromation/billingInfromation/Bank"/></td>
                    <td>Account Id : <xsl:value-of select="MedicalInfromation/billingInfromation/AccountId"/></td>
                    <td colspan="4"></td>
                  </tr>  
                  
                </xsl:for-each>
              </tbody>
            </table>
          </div>
           <div class="row text-success">
            <br/><br/>
            <h3>Insurance Company</h3>
          </div>
          <div class="row">
            <table  class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Company Id</th>
                  <th>Company Name</th>
                  <th>location</th>
                  <th>Revenue</th>
                  <th>Employees</th>
                </tr>
              </thead>
               <tbody>
                <xsl:for-each select="data/insuranceComapny/company">
                <xsl:sort select="@id" order="ascending"/> 
                  <tr class="bg-warning">
                    <td><xsl:value-of select="position()"/>) <xsl:value-of select="companyId"/></td>
                    <td><xsl:value-of select="companyName"/></td>
                    <td><xsl:value-of select="location"/></td>
                    <td><xsl:value-of select="revenue"/></td>
                    <td><xsl:value-of select="employees"/></td>
                  </tr>
                  <tr>
                    <td colspan="2"># User Id : <xsl:value-of select="customerDetails/customerId"/></td>
                    <td colspan="2">Balance Left : <xsl:value-of select="customerDetails/totalBalance"/></td>
                    <td>Time Period : <xsl:value-of select="customerDetails/timePeriod"/></td>
                  </tr>
                    <xsl:for-each select="customerDetails/transactions/transaction">
                     <tr>
                       <td># <xsl:value-of select="position()"/></td> 
                       <td>Transaction ID : <xsl:value-of select="transactionId"/></td>
                       <td>Date : <xsl:value-of select="date"/></td>
                       <td>Debit Amount : <xsl:value-of select="amountDebit"/></td>
                       <td><xsl:value-of select="reason"/></td>
                     </tr> 
                   </xsl:for-each>
                </xsl:for-each>
              </tbody>
            </table>
          </div>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>  