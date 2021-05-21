<?xml version="1.0" encoding="utf-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <html>
      <head>
        <title>Patient | Insurance | Data </title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
      </head>
      <body>
        <div class="container-fluid">
          <div class="row">
            <br/>
          </div>
         <div class="row text-dark">
            <h1>Electrical Medical Record</h1>
          </div>
          <div class="row text-primary">
            <h2>Patient Information</h2>
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
                  <th>Immunization Status</th>
                  <th>Consultations No.</th>
                  <th>Surgeries No </th>
                  <th>Laboraroty Test Results</th>
                  <th>Bank </th>
                  <th>Account Id</th>

                  
                 </tr>
              </thead>
               <tbody>
                <xsl:for-each select="data/electricalMedicalRecord/patientInfromation">
                  <tr>
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
                    <td><xsl:value-of select="MedicalInfromation/immunizationStatus"/></td>
                    <td><xsl:value-of select="MedicalInfromation/medicalHistory/consultations"/></td>
                    <td><xsl:value-of select="MedicalInfromation/medicalHistory/surgeries"/></td>
                    <td><xsl:value-of select="MedicalInfromation/medicalHistory/LaborarotyTestResults"/></td>
                    <td><xsl:value-of select="MedicalInfromation/billingInfromation/Bank"/></td>
                    <td><xsl:value-of select="MedicalInfromation/billingInfromation/AccountId"/></td>
                  </tr>  
                  
                </xsl:for-each>
              </tbody>
            </table>
          </div>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>  