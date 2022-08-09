<?xml version="1.0"?>
<xsl : stylesheet version="1.0" xmlns:xsl="htttp://www.w3.org/1999/XSL/Transform">
<xsl : template match="/">

<html>
<center>
<body>
<h2>welcome to lunch home</h2>

<table border='2'>

<tr bgcolor="green">
<th>SC. No</th>
<th>Item</th> 
<th>Description</th>
<th>Price</th> 
<th>Calories</th> 
</tr>
<xsl:for-each select="breakfast_menu/food">
<xsl:sort select="price"/> 
<tr>
<td><xsl:value-of select="srno"/></td> 
<td><xsl:value-of select="name"/></td>
<td><xsl:value-of select="description"/></td>
<td><xsl:value-of select="price"/></td>
<td><xsl:value-of select="calories"/></td>
</tr>

</xsl:for-each>
</table> 
</body> 
</center> 
</html>
</xsl:template> 
</xsl:stylesheet>
