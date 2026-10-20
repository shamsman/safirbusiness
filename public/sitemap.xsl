<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
    xmlns:html="http://www.w3.org/TR/REC-html40"
    xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:xhtml="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml" lang="en">
            <head>
                <title>XML Sitemap - Safir Business Hub</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <style type="text/css">
                    body {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                        color: #1e293b;
                        background: #f8fafc;
                        margin: 0;
                        padding: 30px;
                    }
                    .container {
                        max-width: 1200px;
                        margin: 0 auto;
                        background: #ffffff;
                        padding: 30px;
                        border-radius: 12px;
                        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
                    }
                    h1 {
                        font-size: 24px;
                        font-weight: 700;
                        color: #0f172a;
                        margin-top: 0;
                        margin-bottom: 8px;
                    }
                    p.desc {
                        font-size: 14px;
                        color: #64748b;
                        margin-bottom: 24px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        font-size: 13px;
                    }
                    th {
                        background-color: #f1f5f9;
                        color: #475569;
                        font-weight: 600;
                        text-align: left;
                        padding: 12px 14px;
                        border-bottom: 2px solid #e2e8f0;
                    }
                    td {
                        padding: 10px 14px;
                        border-bottom: 1px solid #f1f5f9;
                        vertical-align: middle;
                    }
                    tr:hover {
                        background-color: #f8fafc;
                    }
                    a {
                        color: #2563eb;
                        text-decoration: none;
                        font-weight: 500;
                    }
                    a:hover {
                        text-decoration: underline;
                    }
                    .badge {
                        display: inline-block;
                        padding: 2px 8px;
                        font-size: 11px;
                        font-weight: 600;
                        border-radius: 4px;
                        background: #e0f2fe;
                        color: #0369a1;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <h1>Safir Business Hub – XML Sitemap</h1>
                    <p class="desc">This is an XML Sitemap generated for search engines like Google and Bing. Total URLs: <xsl:value-of select="count(sitemap:urlset/sitemap:url)"/></p>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50%;">URL</th>
                                <th>Priority</th>
                                <th>Change Freq</th>
                                <th>Last Modified</th>
                            </tr>
                        </thead>
                        <tbody>
                            <xsl:for-each select="sitemap:urlset/sitemap:url">
                                <tr>
                                    <td>
                                        <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
                                    </td>
                                    <td>
                                        <span class="badge"><xsl:value-of select="sitemap:priority"/></span>
                                    </td>
                                    <td>
                                        <xsl:value-of select="sitemap:changefreq"/>
                                    </td>
                                    <td style="color: #64748b;">
                                        <xsl:value-of select="sitemap:lastmod"/>
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
